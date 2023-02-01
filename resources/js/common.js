const nl2br = (str) => {
    let res = str.replace(/\r\n/g, "<br>");
    res = res.replace(/(\n|\r)/g, "<br>")
    return res;
}

const getToday = () => {
    const today = new Date();
    const year = today.getFullYear();
    const mm = ("0"+(today.getMonth()+1)).slice(-2);
    const dd = ("0"+(today.getDate())).slice(-2);
    return year+'-'+mm+'-'+dd;
} 

export { nl2br, getToday }