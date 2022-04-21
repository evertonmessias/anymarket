// ANYMARKET PLUGIN
window.onload = ()=>{

    var url = window.location.href; 
    var nid = url.split('/')[5];   
    var teste = /checkout\/order-pay\//.test(url);   

    if(teste){
        console.log("PAGAMENTO: "+nid);
        fetch(`/anymarket/?nid=${nid}`)
        .then((response) => response.json())
        .then((data) => console.log(data))
        .catch((error) => console.error(error))
    }
}