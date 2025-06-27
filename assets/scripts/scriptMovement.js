window.addEventListener('DOMContentLoaded', function() {
    const player = document.getElementById('player');
    const parent = this.document.getElementById('player-area');
    console.log(parent);
    const parentRect = parent.getBoundingClientRect();

    const maxLife = 100;
    let staminaInterval = null;
    let replenishTimeout = null;
    let curStamina = 100;
    const maxStamina = 100;
    const depStamina = 10;

    const actions = Array.from(document.querySelectorAll('#player-actions p'));
    const actionsContainer = document.getElementById('player-actions');

    fetch('../model/getChar.php')
    .then(response => response.json())
    .then(data => {
        if (data) {
            console.log("data properly received");
            // here we should fetch the data and handle within the GUI elements
            
            if (data.imagem) {
                player.style.backgroundImage = `url('${data.imagem}')`;
            } 
        } else {
            console.log("data not received");
        }
        
    })
    .catch(error => {
        console.log("erro ao obter: ", error);
    });

    if (player && parent) {
        console.log(parent.offsetHeight);
        console.log("topo: "+ parent.style.top);
        console.log("base: "+ parseFloat(parent.style.top) + parent.clientHeight);
        const player_size = 50;
        let speed = 5;
        const keys = {};
        let pressedSpacebar = 0;
        // Start at (0,0) inside parent
        let pos = { x: (parent.clientWidth + parent.style.left) / 2, y: (parent.clientHeight + parent.style.top) / 2 };

        player.style.width = player_size + 'px';
        player.style.height = player_size + 'px';

        // Calculate boundaries
        const maxX = parent.clientWidth - player.offsetWidth;
        const maxY = parent.clientHeight - player.offsetHeight;
        const minX = parent.style.top;
        const minY = parent.style.left;

        document.addEventListener('keydown', function(e) {
            if (!keys[e.key]) {
                keys[e.key] = true;
                
                if(e.key === ' ') {
                    confirmAction();
                }
                if(e.key == 'Shift')
                    if(curStamina > 50)
                        staminaReplenish(true);
                }
            });
            
        function confirmAction() {
            const action = document.querySelector('#player-actions p.active');
            if(action) {
                action.click();
                setClicked(true);
            }
                //action.dispatchEvent(new MouseEvent('click', {bubbles: true}));
            else
                console.log("not an action element");
        }

        document.addEventListener('keyup', function(e) {
            if (keys[e.key]) {
                keys[e.key] = false;
                
                if(e.key == 'Shift') 
                    staminaReplenish(false);
            }       
            
        });

        function updateLifebar(currentLife, maxLife) {
            const lifebar = document.getElementById("lifebar");
            const percent = Math.max(0, Math.min(100, (currentLife/maxLife) * 100))
            lifebar.style.width = percent + '%';
        }

        function staminaReplenish(state) {
            const stamina = document.getElementById("stamina");
            clearInterval(staminaInterval);
            clearTimeout(replenishTimeout);

            if (state) {
                // Deplete stamina while Shift is held
                staminaInterval = setInterval(() => {
                    if (curStamina > 0) {
                        curStamina = Math.max(0, curStamina - depStamina);
                        stamina.style.width = curStamina + '%';
                        speed = 10;
                    } else {
                        clearInterval(staminaInterval);
                        speed = 5;
                    }
                }, 200);
            } else {
                // Wait 1.5s, then start replenishing
                replenishTimeout = setTimeout(() => {
                    staminaInterval = setInterval(() => {
                        if (curStamina < maxStamina) {
                            curStamina = Math.min(maxStamina, curStamina + depStamina);
                            stamina.style.width = curStamina + '%';
                        } else {
                            clearInterval(staminaInterval);
                        }
                    }, 200);
                }, 1500);
            }
        }

        function updatePosition() {
            if (keys['ArrowUp']) {
                pos.y = Math.max(minY, pos.y - speed);
            }
            if (keys['ArrowDown']) {
                pos.y = Math.min(maxY, pos.y + speed);
            }
            if (keys['ArrowLeft']) {
                pos.x = Math.max(minX, pos.x - speed);
            }
            if (keys['ArrowRight']) {
                pos.x = Math.min(maxX, pos.x + speed);
            }

            player.style.left = pos.x + 'px';
            player.style.top = pos.y + 'px';

            let playerRect = player.getBoundingClientRect();
            /*actions.forEach(action => {
                let actionRect = action.getBoundingClientRect();
                // Check if player overlaps action
                if (
                    playerRect.right > actionRect.left &&
                    playerRect.left <= actionRect.right &&
                    playerRect.bottom > actionRect.top &&
                    playerRect.top <= actionRect.bottom
                ) {
                    action.classList.add('active');
                } else {
                    action.classList.remove('active');
                }
            });
            */
            for (let action of actions) {
                for(let action of actions) {
                    action.classList.remove('active');
                }
                let actionRect = action.getBoundingClientRect();
                if (
                    playerRect.right > actionRect.left &&
                    playerRect.left < actionRect.right &&
                    playerRect.bottom > actionRect.top &&
                    playerRect.top < actionRect.bottom
                ) {
                    action.classList.add('active');
                    break; // Only one can be active
                } else {
                    action.classList.remove('active');
                    setClicked(false);
                }
            }
            requestAnimationFrame(updatePosition);
        }
        requestAnimationFrame(updatePosition);

        updateLifebar(100, maxLife);
    } else {
        console.error("Player element not found");
    }
    //requestAnimationFrame(updatePosition);
});