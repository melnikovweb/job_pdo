const prevDay = localStorage.getItem("country_date");
const today = new Date().getDate();

if (Number(prevDay) !== today){
  localStorage.setItem("country_date", today);
  localStorage.removeItem("person_country");
}

const personCountry = localStorage.getItem("person_country");

if (!personCountry) {
    (function(g,e,o,t,a,r,ge,tl,y){
        t=g.getElementsByTagName(e)[0];y=g.createElement(e);y.async=true;
        y.src='https://g1386590346.co/gl?id=-Nj38a6FXjpl6c2p_Lcy&refurl='+g.referrer+'&winurl='+encodeURIComponent(window.location);
        t.parentNode.insertBefore(y,t);
        })(document,'script');
        
        function geotargetly_loaded(){
          const country_code = geotargetly_country_code();
            localStorage.setItem("person_country", country_code);
        }
}
