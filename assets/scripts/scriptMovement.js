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
        console.log(parent.offsetHeight);
        console.log("topo: "+ parent.style.top);
        console.log("base: "+ parseFloat(parent.style.top) + parent.clientHeight);
        const player_size = 50;
        let speed = 5;
        const keys = {};
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
            keys[e.key] = true;
        });

        document.addEventListener('keyup', function(e) {
            keys[e.key] = false;
        });

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
            if (keys[' ']) {
                console.log(pos.y, pos.x);
            }
            if (keys['Shift']) {
                speed = 10;
            } else {
                speed = 5;
            }

            player.style.left = pos.x + 'px';
            player.style.top = pos.y + 'px';

            requestAnimationFrame(updatePosition);
        }

        requestAnimationFrame(updatePosition);
    } else {
        console.error("Player element not found");
    }
    requestAnimationFrame(updatePosition);
});