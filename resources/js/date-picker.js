import flatpickr from 'flatpickr';
import { Japanese } from 'flatpickr/dist/l10n/ja.js';
import 'flatpickr/dist/flatpickr.css';

const DATE_FORMAT = 'Y-m-d';

const bindDatePicker = (input) => {
    if (!(input instanceof HTMLInputElement)) {
        return;
    }

    if (input._flatpickr) {
        input._flatpickr.setDate(input.value, false, DATE_FORMAT);
        return;
    }

    flatpickr(input, {
        locale: Japanese,
        dateFormat: DATE_FORMAT,
        defaultDate: input.value || null,
        allowInput: true,
        clickOpens: true,
        disableMobile: false,
    });
};

const initializeDatePickers = (root = document) => {
    const inputs = root.querySelectorAll('[data-date-picker]');

    inputs.forEach(bindDatePicker);
};

const watchForNewInputs = () => {
    const observer = new MutationObserver((mutations) => {
        mutations.forEach(({ addedNodes }) => {
            addedNodes.forEach((node) => {
                if (!(node instanceof HTMLElement)) {
                    return;
                }

                if (node.matches('[data-date-picker]')) {
                    bindDatePicker(node);
                    return;
                }

                const nestedInputs = node.querySelectorAll?.('[data-date-picker]');
                if (nestedInputs?.length) {
                    nestedInputs.forEach(bindDatePicker);
                }
            });
        });
    });

    observer.observe(document.body, { childList: true, subtree: true });
};

const boot = () => {
    initializeDatePickers();
    watchForNewInputs();
};

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', boot, { once: true });
} else {
    boot();
}
