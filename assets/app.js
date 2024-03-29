/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';
import 'bootstrap/dist/js/bootstrap.bundle';

import { createApp } from 'vue'; // Import createApp
import App from './components/App.vue';

const app = createApp(App);
app.mount('#app');