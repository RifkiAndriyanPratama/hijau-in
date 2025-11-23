import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Photo modal preview logic (vanilla JS)
document.addEventListener('DOMContentLoaded', () => {
	const modal = document.getElementById('photo-modal');
	if (!modal) return;
	const imgTag = modal.querySelector('img');
	const closeBtn = modal.querySelector('[data-close-modal]');

	function closeModal() {
		modal.classList.add('hidden');
		imgTag.removeAttribute('src');
	}

	document.querySelectorAll('[data-photo-preview]').forEach(el => {
		el.addEventListener('click', e => {
			e.preventDefault();
			const src = el.getAttribute('data-photo-preview');
			if (!src) return;
			imgTag.setAttribute('src', src);
			modal.classList.remove('hidden');
		});
	});

	modal.addEventListener('click', e => {
		if (e.target === modal) {
			closeModal();
		}
	});
	if (closeBtn) {
		closeBtn.addEventListener('click', closeModal);
	}
	document.addEventListener('keydown', e => {
		if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
			closeModal();
		}
	});
});
