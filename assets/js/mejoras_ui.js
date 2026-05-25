
(() => {
  const btn = document.getElementById('hamburguesa');
  const menu = document.getElementById('menu');

  if (btn && menu && !btn.dataset.uiMenuReady) {
    btn.dataset.uiMenuReady = '1';
    btn.setAttribute('aria-controls', 'menu');
    btn.setAttribute('aria-expanded', 'false');

    const setMenu = (open) => {
      menu.classList.toggle('menu-active', open);
      btn.setAttribute('aria-expanded', open ? 'true' : 'false');
    };

    btn.addEventListener('click', (event) => {
      event.stopPropagation();
      setMenu(!menu.classList.contains('menu-active'));
    });

    menu.addEventListener('click', (event) => event.stopPropagation());
    document.addEventListener('click', () => setMenu(false));
    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') setMenu(false);
    });
  }

  document.querySelectorAll('.form-favorito').forEach((form) => {
    if (form.dataset.uiFavReady) return;
    form.dataset.uiFavReady = '1';

    form.addEventListener('submit', (event) => {
      const button = form.querySelector('.favorito');
      const img = button?.querySelector('img');
      if (!button || !img || button.classList.contains('guardado')) return;

      event.preventDefault();
      button.classList.add('animando', 'guardado');
      if (img.dataset.lleno) img.src = img.dataset.lleno;
      window.setTimeout(() => form.submit(), 420);
    });
  });


  // Confirmación bonita al eliminar comentarios
  const deleteCommentForms = document.querySelectorAll('.form-eliminar-comentario');
  if (deleteCommentForms.length && !document.getElementById('confirmDeleteCommentModal')) {
    const modal = document.createElement('div');
    modal.id = 'confirmDeleteCommentModal';
    modal.className = 'confirm-modal';
    modal.innerHTML = `
      <div class="confirm-card" role="dialog" aria-modal="true" aria-labelledby="confirmDeleteTitle">
        <h3 id="confirmDeleteTitle">Eliminar comentario</h3>
        <p>¿Estás seguro que desea eliminar este comentario?</p>
        <div class="confirm-actions">
          <button type="button" class="confirm-cancel">Cancelar</button>
          <button type="button" class="confirm-delete">Eliminar</button>
        </div>
      </div>
    `;
    document.body.appendChild(modal);

    let pendingForm = null;
    const closeModal = () => {
      modal.classList.remove('visible');
      pendingForm = null;
    };

    deleteCommentForms.forEach((form) => {
      form.addEventListener('submit', (event) => {
        if (form.dataset.confirmed === '1') return;
        event.preventDefault();
        pendingForm = form;
        modal.classList.add('visible');
      });
    });

    modal.querySelector('.confirm-cancel')?.addEventListener('click', closeModal);
    modal.querySelector('.confirm-delete')?.addEventListener('click', () => {
      if (!pendingForm) return;
      pendingForm.dataset.confirmed = '1';
      pendingForm.submit();
    });
    modal.addEventListener('click', (event) => {
      if (event.target === modal) closeModal();
    });
    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') closeModal();
    });
  }
})();
