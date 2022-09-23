const letterToggle = document.querySelector('.pj-search-letters-link');
const letterContainer = document.querySelector('.pj-search-letters');

letterToggle.addEventListener(
	'click',
	(e) => {
		e.preventDefault();
		letterContainer.classList.toggle('active');
	}
);
