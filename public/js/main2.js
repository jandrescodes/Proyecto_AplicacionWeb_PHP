(() => {
    const toggle = document.getElementById('verPassword');
    const input = document.getElementById('contrasena');
    if (!toggle || !input) {
        return;
    }

    let visible = false;

    toggle.addEventListener('click', () => {
        visible = !visible;
        input.type = visible ? 'text' : 'password';
        toggle.setAttribute('aria-pressed', String(visible));
        toggle.setAttribute('aria-label', visible ? 'Ocultar contraseña' : 'Mostrar contraseña');
    });
})();