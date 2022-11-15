window.addEventListener('load', function(){
    let country_button = document.getElementById('lookup_country');
    let city_button = document.getElementById('lookup_city');
    country_button.addEventListener('click', () => {performLookup('country')} )
    city_button.addEventListener('click', () => {performLookup('city')} )
});

async function performLookup(lookup_Type){
    let input = document.getElementById('country');
    let result = document.getElementById('result');
    let lookup_url = '';
    if (lookup_Type === 'city'){
        lookup_url = `./world.php?country=${input.value}&context=cities`;
    }else{
        lookup_url = `./world.php?country=${input.value}&context=''`;
    }
    const response = await fetch(lookup_url).then((response) => {
        let data = response.text();
        return data;
   })

   console.log (response);
   result.innerHTML = response;
}
