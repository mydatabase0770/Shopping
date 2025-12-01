import './bootstrap';
import Alpine from 'alpinejs';
import Swal from 'sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

// Initialize Alpine.js
window.Alpine = Alpine;
Alpine.start();

// Make Swal available globally
window.Swal = Swal;
