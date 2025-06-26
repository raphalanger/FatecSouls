let pointerInterval = null;
let pointerPos = 0; // 0 to 1 (percentage of bar)
let pointerSpeed = 0.005; // Adjust for speed
let pointerActive = false; // tells if the pointer is active or no
let pointerValue = 0; // 0 to 1, increases to 0.5, then decreases to 0
let bar, pointer, damager;

function setDamager(bar1, pointer1) {
    bar = bar1;
    pointer = pointer1;
}
function showAttack() {
    bar.style.display = 'flex';
    pointerPos = 0;
    pointerActive = true;
    movePointer();
}

function movePointer() {
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
// encerrar o ataque na hora do clique
document.addEventListener('keydown', function(e) {
    if (pointerActive && e.key === ' ') {
        pointerActive = false;
        clearInterval(pointerInterval); 
        setAttack(pointerValue); // Use the value (0 to 1)
    }
});
function setAttack(value) { 
    // Do something with the value (0 to 1) 
    //alert('Valor do ataque: ' + Math.round(value * 100)); 
    console.log("Dano: "+value); 
    bar.style.display = 'none'; 
    clearInterval(pointerInterval); 
}