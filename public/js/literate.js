/* Модифицированная функция с сайта http://blogjquery.ru/translit-simvolov-v-jquery-iz-russkix-v-latinicu/ */

function urlLit(w) {
    var tr='a b v g d e ["zh","j"] z i y k l m n o p r s t u f h c ch sh ["shh","shch"] ~ y ~ e yu ya ~ ["jo","e"]'.split(' ');
    var ww=''; 
    w=w.toLowerCase();
    for(i=0; i<w.length; ++i) {
        cc=w.charCodeAt(i); 
        ch=(cc>=1072 ? tr[cc-1072] : w[i]);
        if(ch.length<3) 
            ww+=ch; 
    }
    return(ww.replace(/[^a-zA-Z0-9\_\.]/g,'_').replace(/[_]{2,}/gim, '_').replace( /^\_+/g, '').replace( /\_+$/g, ''));
}
