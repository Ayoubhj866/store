<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mary\Traits\Toast;
use RealRashid\Cart\Facades\Cart;

class Checkout extends Component
{
    use Toast;

    public $items = [];

    public $total_amount = 0;

    protected User $user;

    #[Validate('required|regex:/^(?:[0-9]{4} ?[0-9]{4} ?[0-9]{4} ?[0-9]{4}) ?\/ ?([0-9]{3})$/')]
    public $card_number;

    public function messages()
    {
        return [
            'card_number.required' => 'Please fill the card number and cvc number',
            'card_number.*' => 'Card number format is invalid. (e.g : 0000 0000 0000 0000/000)',
        ];
    }

    /**
     * checkout : process the parment and place the order
     *
     * @return void
     */
    public function checkout()
    {
        if (Auth::check()) {
            //validate the card and cvc numbers
            $this->validate();

            DB::beginTransaction();
            try {
                $this->items = Cart::all();
                $this->total_amount = Cart::total();
                $this->user = Auth::user();

                if (Cart::count() > 0) {
                    // crate the order
                    $order = $this->user->orders()->create([
                        'uuid' => (string) Str::uuid(),
                        'total_amount' => $this->total_amount,
                        'status_date' => now(),
                    ]);

                    // crate pivote table order_items
                    foreach ($this->items as $item) {
                        $order->products()->attach($item->model->id, [
                            'quantity' => $item->quantity,
                            'unit_price' => $item->price,
                        ]);
                    }

                    // create the paymet (latter i will add a strip methode payment...)
                    $order->payment()->create([
                        'amount' => $this->total_amount,
                        'payment_status' => 'pending',
                        'transaction_id' => 'ab1502526',
                        'payment_response' => 'this is the payment response hard codded',
                    ]);

                    // database will commited if all operation success
                    DB::commit();

                    // clear the cart
                    Cart::clear();
                    $this->dispatch('cart-changer');
                    $this->success('Payment success, your order is on review !',
                        position : 'bottom-end',
                        redirectTo: route('order-tracker', $order));
                } else {
                    $this->error('You don\'t have items in cart !', position : 'bottom-end');
                }
            } catch (\Exception $e) {
                DB::rollBack();

                dd($e);
                $this->error('Process failed', position : 'bottom-end');
            }
        } else {
            $this->error('Process failed !', position : 'bottom-end');
        }
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
