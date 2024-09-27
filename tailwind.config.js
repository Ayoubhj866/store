import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */

export default {
	content: [
		'./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
		'./vendor/laravel/jetstream/**/*.blade.php',
		'./storage/framework/views/*.php',
		'./resources/views/**/*.blade.php',
		"./vendor/robsontenorio/mary/src/View/Components/**/*.php",
		'./vendor/tallstackui/tallstackui/src/**/*.php',
	],

	presets: [
		require('./vendor/tallstackui/tallstackui/tailwind.config.js')
	],

	darkMode: "class",

	daisyui: {
		themes: [
			"cupcake",
			{
				cupcake: {
					...require("daisyui/src/theming/themes")["cupcake"],
					// primary: "#3457D5",
					primary: "#6d28d9",
					// primary: "teal",
					".bg-primary": {
						"background-color": "#3457D5",
					},
					".btn-purple": {
						'background-color': "#6d28d9",
						"color": "#fff",
					},
					".btn-purple:hover": {
						'background-color': "#7c3aed",
						"color": "#fff",
					}
				},
			},

		],
	},

	theme: {
		extend: {
			fontFamily: {
				sans: ['Figtree', ...defaultTheme.fontFamily.sans],
				poppins: ['Poppins'],
			},
			colors: {
				primary: {
					default: "#3457D5",
					'500': "#3457D5",
				}
			}
		},
	},

	plugins: [
		forms,
		typography,
		require("daisyui")
	],
};
