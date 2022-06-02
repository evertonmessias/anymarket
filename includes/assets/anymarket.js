// ANYMARKET PLUGIN
window.onload = () => {

    var url = window.location.href;
    var nid = url.split('/')[5];
    var wid = ((url.split('?')[1]).split('&')[0]).replace(/^\D+/g, '');
    var teste1 = /checkout\/order-pay\//.test(url);
    var teste2 = /checkout\/order-received\//.test(url);

    if (teste1) {
        console.log("PAGAMENTO: " + nid);
        fetch(`/anymarket/?nid=${nid}`)
            .then((response) => response.json())
            .then((data) => console.log(data))
            .catch((error) => console.error(error));
    }

    if (teste2) {
        console.log("FATURADO: " + nid);
        fetch(`/invoiced/?nid=${nid}`)
            .then((response) => response.json())
            .then((data) => console.log(data))
            .catch((error) => console.error(error))
    }

    var completed = document.querySelector("button.save_order.button-primary")
    if (completed) {
        completed.onclick = function () {
            console.log("COMPLETED: " + wid);
            fetch(`/completed/?nid=${wid}`)
                .then((response) => response.json())
                .then((data) => console.log(data))
                .catch((error) => console.error(error))
        }
    }
}