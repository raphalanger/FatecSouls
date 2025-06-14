window.addEventListener('DOMContentLoaded', function() {
    const player = document.getElementById('player');
    const parent = player.parentElement;
    
    fetch('../model/getImage.php')
    .then(response => response.json())
    .then(data => {
        if (data.imagem) {
            player.style.backgroundImage = `url('${data.imagem}')`;
        }

    })
    .catch(error => {
        console.log("erro ao obter imagem: ",error);
    });

    if (player && parent) {
        let pos = { x: 100, y: 100 };
        player.style.width = 100 + 'px';
        player.style.height = 100 + 'px';
        const speed = 10;
        const keys = {};
        let playerBound = player.getBoundingClientRect();
        parent.style.width = playerBound.width * 5 + 'px';
        parent.style.height = playerBound.height * 5 + 'px';

        function updatePosition() {
            if (keys['ArrowUp']) {
                if ( pos.y <= parent.clientTop) {
                    pos.y = parent.clientTop;
                } else {
                    pos.y -= speed;
                }
            }
            else if (keys['ArrowDown']) {
                if ( pos.y >= (parent.clientHeight - player.clientHeight) ) {
                    pos.y = parent.clientHeight - player.clientHeight;
                } else {
                    pos.y += speed;
                }
            }
            else if (keys['ArrowLeft']) {
                if ( pos.x <= parent.clientLeft) {
                    pos.x = parent.clientLeft;
                } else {
                    pos.x -= speed;
                }
            }
            else if (keys['ArrowRight']) {
                if ( pos.x >= (parent.clientWidth - player.clientWidth)) {
                    pos.x = parent.clientWidth - player.clientWidth;
                } else {
                    pos.x += speed;
                }
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