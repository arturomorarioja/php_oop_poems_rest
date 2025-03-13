/**
 * December 2024 - Original JQuery code translated to vanilla 
 *      JavaScript by ChatGPT-4o, then amended manually
 * March 2025 - Code adjusted for the new REST API
 */
import { API_BASE_URL } from './info.js';
import { createElement } from './utils.js';

/**
 *  Initial poets load
 */
fetch(`${API_BASE_URL}/authors`)
.then(response => response.json())
.then(info => {
    const cmbPoets = document.getElementById('cmbPoets');
    info.data.forEach(author => {
        const option = createElement('option', { text: author });
        cmbPoets.appendChild(option);
    });
    // The first poet is selected automatically
    cmbPoets.dispatchEvent(new Event('change'));
});

/**
 *  Poet selection
 */
document.getElementById('cmbPoets').addEventListener('change', function () {
    const selectedPoet = this.options[this.selectedIndex].text;

    // Load poet information
    fetch(`${API_BASE_URL}/authors/${encodeURIComponent(selectedPoet)}`)
    .then(response => response.json())
    .then(info => {
        info = info.data;
        let dates = `${info.birthPlace}, ${info.birthDate}`;
        if (info.deathDate !== undefined) {
            dates += `- ${info.deathPlace}, ${info.deathDate}`;
        }
        document.getElementById('poetInfo').textContent = dates;
    });

    // Load poet's list of poems
    fetch(`${API_BASE_URL}/authors/${encodeURIComponent(selectedPoet)}/poems`)
        .then(response => response.json())
        .then(info => {
            const poemsContainer = document.getElementById('poems');
            poemsContainer.innerHTML = '';

            const container = new DocumentFragment;
            info.data.forEach(poemTitle => {
                const poemArticle = createElement('article');
                const poemHeader = createElement('h3', { text: poemTitle, class: 'closedPoem' });

                poemHeader.addEventListener('click', poemHandler);

                poemArticle.appendChild(poemHeader);
                container.appendChild(poemArticle);
            });
            poemsContainer.append(container);
        });
});

/**
 * Handles the click event on the title of a poem,
 * which causes the text of the poem to be loaded
 */
function poemHandler() {
    const poemHeader = this;
    const poemArticle = poemHeader.parentNode;
    const selectedPoet = document.getElementById('cmbPoets').options[
        document.getElementById('cmbPoets').selectedIndex
    ].text;

    // If the poem text is visible, remove it
    const poemTextDiv = poemArticle.querySelector('div');
    if (poemTextDiv) {
        poemHeader.classList.remove('openPoem');
        poemHeader.classList.add('closedPoem');
        poemTextDiv.remove();
    } else {
        // If the poem is not visible, load it
        fetch(
            `${API_BASE_URL}/authors/${encodeURIComponent(selectedPoet)}/poems/${encodeURIComponent(poemHeader.textContent)}`
        )
        .then(response => response.json())
        .then(info => {
            const poemTextDiv = createElement('div', { html: info.data.text });
            poemHeader.classList.remove('closedPoem');
            poemHeader.classList.add('openPoem');
            poemArticle.appendChild(poemTextDiv);
        });
    }
}