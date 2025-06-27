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

    const levelup = this.document.getElementById('upgrade-overlay');
    const keys = {};
    let openMenu;
    let status = false;
    function saveState() {
        // fazer um ajax e salvar os status do jogador
    }
    const leave = this.document.getElementById('leave').addEventListener('click', function() {
        saveState();
    });
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
    this.document.addEventListener('keydown', function(e) {
        if(!keys[e.key]) {
            keys[e.key] = true;
            if(e.key == 'Escape') {
                if (openMenu == 'Item')
                    hideDialog();
                else if (openMenu == 'Ação')
                    hideDialog();
                else if (openMenu == 'Nível')
                    hideLevelTable(); 
                else if (openMenu == 'Fugir')
                    hideDialog();
            }
        }
    });
    this.document.addEventListener('keyup', function(e) {
        if(keys[e.key])
            keys[e.key] = false;
    })
    document.querySelectorAll('#player-actions p').forEach(p => {
        p.addEventListener('click', function() {
            openMenu = p.textContent;
            if(p.textContent == 'Atacar' && !clicked) {
                setDamager(bar, pointer);
                showAttack(); // calls the attack manager
            }
            if(p.textContent == 'Item' && !clicked) {
                showDialog('<button id="estus">Frasco de Estus</button><button id="blossom">Flor Verde</button>');
                //setTimeout(setItemEvents, 0);
                setItemEvents(p.textContent);
            }
            if(p.textContent == 'Ação' && !clicked) {
                showDialog('<button id="level" class="level">Subir de Nível</button><button id="pray" class="pray">Rezar</button><button id="rest" class="rest">Descansar</button><button id="gnosis" class="gnosis">Obter a Gnose</button>');
                //setTimeout(setItemEvents, 0);
                setItemEvents(p.textContent);
            }
            if(p.textContent == 'Fugir') { showDialog('Covarde!') }
        });
    });
    function setItemEvents() {
        this.document.querySelectorAll('#dialog-content button').forEach(btn => {
            btn.addEventListener('click', function() {
                if(btn.id == 'estus') {
                    console.log('estus clicked');
                    hideDialog();
                }
                else if(btn.id == 'blossom') {
                    // raises stamina recovery for one round
                    hideDialog();
                }
                else if(btn.id == 'level') {
                    console.log('level up clicked');
                    hideDialog();
                    openMenu = 'Nível';
                    showLevelTable();
                }
                else if(btn.id == 'pray') { 
                    hideDialog();
                }
                else if(btn.id == 'rest') {
                    hideDialog();
                }
                else if(btn.id == 'gnosis') {
                    hideDialog();
                }
            })
        });
    }
    function showLevelTable() {
        levelup.style.display = 'flex';
        status = true;
        console.log("level clicked");
        addLevelButtonListeners();
        addConfirmButtonListener();
    }
    function hideLevelTable() {
        levelup.style.display = 'none';
        status = false;
    }
    function addLevelButtonListeners() {
        // Increment buttons
        document.querySelectorAll('#level-tab #stat-inc').forEach(btn => {
            btn.addEventListener('click', function() {
                const stat = btn.getAttribute('data-stat');
                const valueCell = this.parentElement.parentElement.querySelector('#stat-value');
                let newValue = parseInt(valueCell.textContent) + 1;
                valueCell.textContent = newValue;
            });
        });
        // Decrement buttons
        document.querySelectorAll('#level-tab #stat-dec').forEach(btn => {
            btn.addEventListener('click', function() {
                const stat = btn.getAttribute('data-stat');
                const valueCell = this.parentElement.parentElement.querySelector('#stat-value');
                let newValue = parseInt(valueCell.textContent) - 1;
                valueCell.textContent = newValue;
            });
        });
    }
    function addConfirmButtonListener() {
        const confirmBtn = document.getElementById('set-upgrade');
        if (confirmBtn) {
            confirmBtn.addEventListener('click', function() {
                // For each stat in the level-up table, update the main status display
                document.querySelectorAll('#level-tab #stat-value').forEach(cell => {
                    const stat = cell.getAttribute('data-stat');
                    const mainStat = document.querySelector('.main-stat[data-stat="' + stat + '"]');
                    if (mainStat) mainStat.textContent = cell.textContent;
                });
                // Optionally hide the level-up overlay
                document.getElementById('upgrade-overlay').style.display = 'none';
            });
        }
    }
});
//Apoll0 St4r