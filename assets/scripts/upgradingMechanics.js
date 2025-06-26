let clicked = false;

function setClicked(state) {
    clicked = state;
}
window.addEventListener('DOMContentLoaded', function() {
    const overlay = document.getElementById('dialog-overlay');
    const content = document.getElementById('dialog-content');
    const closeBtn = document.getElementById('dialog-close');
    
    const bar = document.getElementById('damage-tab');
    const pointer = document.getElementById('damage-pointer');

    let status = false;

    // Show dialog with custom content
    function showDialog(message) {
        overlay.style.display = 'flex';
        overlay.style.flexDirection = 'column';
        content.innerHTML = message;
        status = true;
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

    document.querySelectorAll('#player-actions p').forEach(p => {
        p.addEventListener('click', function() {
            if(p.textContent == 'Atacar' && !clicked) {
                setDamager(bar, pointer);
                showAttack(); // calls the attack manager
            }
            if(p.textContent == 'Item') {
                showDialog('<button id="estus">Frasco de Estus</button><button id="green-blossom">Flor Verde</button>');
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