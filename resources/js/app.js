import './bootstrap';
import Echo from 'laravel-echo'

window.Echo = new Echo({
    broadcaster: 'reverb',
    host: window.location.hostname + ':6001',
});

window.Echo.channel('user-notifications')
    .listen('.notification.sent', (e) => {
        console.log('Notifikasi masuk:', e.message)
        // tampilkan notifikasi ke UI
    });
