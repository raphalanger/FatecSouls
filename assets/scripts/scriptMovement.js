window.addEventListener('DOMContentLoaded', function() {
    const player = document.getElementById('player');
    const parent = player.parentElement;
    
    if (player && parent) {
        let pos = { x: 100, y: 100 };
        player.style.width = 100 + 'px';
        player.style.height = 100 + 'px';
        const speed = 10;
        const keys = {};
        let playerBound = player.getBoundingClientRect();
        parent.style.width = playerBound.width * 5 + 'px';
        parent.style.height = playerBound.height * 5 + 'px';
        let parentBound = player.parentElement.getBoundingClientRect();


        //console.log("parent bound: ", parentBound);
        function inBounds() {
            // will check if the position of the player is
            // within the bounds of the parent
            // console.log(playerBound - parentBound);
            position = parentBound.top - playerBound.top;
            //console.log("Position: ", position);
        }
        function updatePosition() {
            if (keys['ArrowUp']) {
                if (playerBound.top < parentBound.top) 
                    pos.y = parentBound.top; // 'clamping'
                else 
                    pos.y -= speed;
            }
            else if (keys['ArrowDown']) {
                if (playerBound.bottom > parentBound.bottom) 
                    pos.y = parentBound.bottom - playerBound.height;
                else 
                    pos.y += speed;
            }
            else if (keys['ArrowLeft']) {
                if (playerBound.left < parentBound.left) 
                    pos.x = parentBound.left;
                else 
                    pos.x -= speed;
            }
            else if (keys['ArrowRight']) {
                if (playerBound.right > parentBound.right)
                    pos.x = parentBound.right - playerBound.width;
                else 
                    pos.x += speed;
            }

            player.style.left = pos.x + 'px';
            player.style.top = pos.y + 'px';
            
            requestAnimationFrame(updatePosition);
        }

        document.addEventListener('keydown', function(e) {
            keys[e.key] = true;
            inBounds();
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