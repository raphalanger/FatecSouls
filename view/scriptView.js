window.addEventListener('DOMContentLoaded', function() {
    console.log("script loaded");
    
    const pwd_btn = document.getElementById('pwd_btn');
    const pwd = document.getElementById('pwd');

    const fakeLink = this.document.getElementById('fakelink');
    const authType = this.document.getElementById('authType');

    const prev = this.document.getElementById("prevClass");
    const next = this.document.getElementById("nextClass");

    const selClass = this.document.getElementById("selectedClass");
    const imgClass = this.document.getElementById("imgClass");

    const burialGift = this.document.getElementById("gift");

    let params = new URLSearchParams(window.location.search);
    let curClassId = parseInt(params.get('idClass')) || 1; 
    let maxClassId = 5;
    let minClassId = 1;

    if(fakeLink) {
        fakeLink.addEventListener('click', function() {
            if (authType.value == "login") {
                authType.value = "register";
                fakeLink.innerHTML = "Já possuo uma conta.";
            }
            else if (authType.value == "register") {
                authType.value = "login";
                fakeLink.innerHTML = "Não possuo uma conta.";
            }
        });
    }

    if(prev && next) {
        console.log("prev and next set");
        prev.addEventListener('click', function() {
            if(curClassId == minClassId)
                curClassId = maxClassId;
            else
                curClassId -= 1;
            console.log(curClassId);
            updateClassDisplay(curClassId);
        });

        next.addEventListener('click', function() {
            if(curClassId == maxClassId)
                curClassId = minClassId;
            else
                curClassId += 1;
            console.log(curClassId);
            updateClassDisplay(curClassId);
        });
    } else
        console.log("prev and next not found");

    function updateClassDisplay(curClassId) {
        url = new URL(window.location);
        url.searchParams.set('idClass', curClassId);
        window.history.replaceState({}, '', url);
        window.location.reload();
        //window.location.href = url.toString();
    }
    //fetchClass(curClassId);

    if (burialGift) {
        burialGift.addEventListener('change', function() {
            let giftValue = burialGift.value;
            url = new URL(window.location);
            url.searchParams.set('idGift', giftValue);
            window.history.replaceState({}, '', url);
            window.location.reload();
            console.log("Gift selected: " + giftValue);
        });
    }
});