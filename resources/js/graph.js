import Chart from 'chart.js/auto'

const statsTitle =  document.getElementById('statsTitle')



if (statsTitle) {
    

(async function() {

    const viewsToArray = Object.entries(views)

    const arr = [];
    
    viewsToArray.forEach(element => {
        element.shift();
        // console.log(element);

        arr.push(element[0])
    });
    
    console.log(arr);



  new Chart(
    document.getElementById('acquisitions'),
    {
      type: 'bar',
      data: {
        labels: arr.map(row => row.mese),
        datasets: [
          {
            label: 'Visualizzazioni per mese',
            data: arr.map(row => row.views)
          }
        ]
      }
    }
  );
})();

}
