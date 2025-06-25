window.addEventListener('DOMContentLoaded', function() {
    const overlay = document.getElementById('dialog-overlay');
    const content = document.getElementById('dialog-content');
    const closeBtn = document.getElementById('dialog-close');

    const damager = this.document.getElementById('damage-tab');
    const pointer = this.document.getElementById('damage-pointer');
    let status = false;
    let pointerInterval = null;
    let pointerPos = 0; // 0 to 1 (percentage of bar)
    let pointerSpeed = 0.005; // Adjust for speed
    let pointerActive = false;
    
    let pointerValue = 0; // 0 to 1, increases to 0.5, then decreases to 0

    // Show dialog with custom content
    function showDialog(message) {
        overlay.style.display = 'flex';
        overlay.style.flexDirection = 'column';
        content.innerHTML = message;
        status = true;
    }

    function showAttack() {
        damager.style.display = 'flex';
        pointerPos = 0;
        pointerActive = true;
        movePointer();
    }

    function movePointer() {
        const bar = document.getElementById('damage-tab');
        const pointer = document.getElementById('damage-pointer');
        const barWidth = bar.offsetWidth;

        pointerInterval = setInterval(() => {
            if (!pointerActive) return;

            pointerPos += pointerSpeed;
            if (pointerPos > 1) setAttack(pointerValue); // Loop

            // Move pointer visually
            pointer.style.left = (pointerPos * barWidth - pointer.offsetWidth / 2) + 'px';

            // Calculate value: increases from 0 to 0.5, then decreases to 0
            if (pointerPos <= 0.5) {
                pointerValue = pointerPos * 2; // 0 to 1
            } else {
                pointerValue = (1 - pointerPos) * 2; // 1 to 0
            }
        }, 10);
    }
    document.addEventListener('keydown', function(e) {
        if (pointerActive && e.key === ' ') {
            pointerActive = false;
            clearInterval(pointerInterval);
            setAttack(pointerValue); // Use the value (0 to 1)
        }
    });
    function setAttack(value) {
        // Do something with the value (0 to 1)
        alert('Valor do ataque: ' + Math.round(value * 100));
        clearInterval(pointerInterval);
        damager.style.display = 'none';
    }

    // Hide dialog
    function hideDialog() {
        document.getElementById('dialog-overlay').style.display = 'none';
        status = false;
    }
    // Close button event
    if (closeBtn) {
        closeBtn.onclick = hideDialog;
    }
    // Optional: close dialog when clicking outside the box
    document.getElementById('dialog-overlay').onclick = function(e) {
        if (e.target === this) hideDialog();
    };

    document.querySelectorAll('#player-actions p').forEach(p => {
        p.addEventListener('click', function() {
            if(p.textContent == 'Atacar') {
                showAttack();
            }
            if(p.textContent == 'Item') {
                showDialog('<button>Frasco de Estus</button><button>Flor Verde</button>');
            }
            if(p.textContent == 'Ação') {
                showDialog('<button>Subir de Nível</button><button>Rezar</button><button>Descansar</button><button>Obter a Gnose</button>');
            }
            if(p.textContent == 'Fugir') {
                showDialog('Covarde!');
            }
        });
    }); 
});
//Apoll0 St4r