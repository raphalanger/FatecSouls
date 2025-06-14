window.addEventListener('DOMContentLoaded', function() {
    const player = document.getElementById('player');
    const parent = this.document.getElementById('player-area');
    console.log(parent);
    const parentRect = parent.getBoundingClientRect();
    
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
        const player_size = 50;
        const arena_scaling = 7;
        let speed = 5;
        const keys = {};
        let pos = { x: parentRect.left, y: parentRect.top };
        let playerBound = player.getBoundingClientRect();
        player.style.width = player_size + 'px';
        player.style.height = player_size + 'px';
        parent.style.width = playerBound.width * arena_scaling + 'px';
        parent.style.height = playerBound.height * arena_scaling + 'px';

        const position = {
            top: parentRect.top + this.window.scrollY,
            left: parentRect.left + this.window.scrollX,
            bottom: parentRect.top + parent.clientHeight,
            right: parentRect.left + parent.clientWidth
        };
        // now everything has its position reference based on the parent element proportions
        console.log(position);

        function updatePosition() {
            if (keys['ArrowUp']) {
                if ( pos.y >= position.top ) {
                    pos.y = position.top;
                } else {
                    pos.y -= speed;
                }
            }
            else if (keys['ArrowDown']) {
                if ( pos.y >= (position.bottom - player.clientHeight) ) {
                    pos.y = position.bottom + player.clientHeight;
                }
            }
            if (keys['ArrowLeft']) {
                if ( pos.x <= position.left) {
                    pos.x = position.left;
                } else {
                    pos.x -= speed;
                }
            }
            else if (keys['ArrowRight']) {
                if ( pos.x >= (position.right - player.clientWidth) ) {
                    pos.x = position.right - player.clientWidth;
                } else {
                    pos.x += speed;
                }
            }
            if (keys[' ']) {
                console.log(pos.y, pos.x, position);
            }
            if (keys['Shift']) {
                //console.log("left shift clicked");
                speed *= 2;
            }

            player.style.left = pos.x + 'px';
            player.style.top = pos.y + 'px';
            
            requestAnimationFrame(updatePosition);
        }

        document.addEventListener('keydown', function(e) {
            keys[e.key] = true;
            //let leftBound = player.getBoundingClientRect().left;
            //let bottomBound = window.innerHeight - player.getBoundingClientRect().bottom;
            //let rightBound = window.innerWidth - player.getBoundingClientRect().right;
            //console.log(`Top: ${topBound}, Left: ${leftBound}, Bottom: ${bottomBound}, Right: ${rightBound}`);
            // Move based on currently pressed keys
        });

        document.addEventListener('keyup', function(e) {
            keys[e.key] = false;
        });
        requestAnimationFrame(updatePosition);
    } else {
        console.error("Player element not found");
    }
});