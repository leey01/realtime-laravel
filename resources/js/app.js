import './bootstrap';

Echo.private('notifications')
    .listen('.App\\Events\\UserSessionChanged', (e) => {
        const noitificationElement = document.getElementById('notification');

        noitificationElement.innerText = e.message;

        noitificationElement.classList.remove('invisible');
        noitificationElement.classList.remove('alert-success');
        noitificationElement.classList.remove('alert-danger');

        noitificationElement.classList.add('alert-' + e.type);
    });
