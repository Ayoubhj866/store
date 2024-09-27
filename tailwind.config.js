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
					...require("daisyui/src/theming/themes")["light"],
					primary: "#00CCDD",
					// primary: "teal",
					".bg-primary": {
						"background-color": "#4F75FF",
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
					default: "#4F75FF",
					'500': "#4F75FF",
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
