import './bootstrap';
document.addEventListener('DOMContentLoaded', function () {
    const idInput = document.getElementById('id');
    const formFields = ['nome', 'idade', 'telefone', 'turma_id', 'ano_letivo'];

    if (idInput) {
        idInput.addEventListener('input', function () {
            const id = idInput.value.trim();

            if (id) {
                fetch(`/alunos/${id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                            formFields.forEach(field => {
                                const input = document.getElementById(field);
                                if (input) {
                                    input.value = data[field] || '';
                                }
                            });
                        } else {
                            alert('Aluno não encontrado.');
                        }
                    })
                    .catch(error => console.error('Erro ao buscar aluno:', error));
            } else {
                formFields.forEach(field => {
                    const input = document.getElementById(field);
                    if (input) {
                        input.value = '';
                    }
                });
            }
        });
    }
});
// resources/js/app.js
document.addEventListener('DOMContentLoaded', function () {
    const telefoneInput = document.getElementById('telefone');

    if (telefoneInput) {
        telefoneInput.addEventListener('input', function () {
            let value = telefoneInput.value.replace(/\D/g, ''); // Remove caracteres não numéricos

            if (value.length > 2) {
                value = `(${value.substring(0, 2)}) ${value.substring(2)}`;
            }

            if (value.length > 10) {
                value = `${value.substring(0, 10)}-${value.substring(10, 15)}`;
            }

            telefoneInput.value = value;
        });
    }
});
import Inputmask from 'inputmask';

document.addEventListener('DOMContentLoaded', function () {
    const telefoneInput = document.getElementById('telefone');

    if (telefoneInput) {
        const im = new Inputmask('(99) 99999-9999');
        im.mask(telefoneInput);
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const requiredInputs = document.querySelectorAll('[required]');

    requiredInputs.forEach(input => {
        input.addEventListener('blur', function () {
            if (!input.value.trim()) {
                input.style.borderColor = 'red';
            } else {
                input.style.borderColor = '';
            }
        });
    });
});