
// console.log("Generating chart..");

// var dataTitle = "TEST 5";
// var dataValues = [5, 5, 5, 5, 5, 5, 5];
// showDataSet(dataTitle, dataValues);





function showDataSet(dataTitle, dataValues)
{
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'polarArea',

    // The data for our dataset
    data: {
        labels: ['#1', '#2', '#3', '#4', '#5', '#6', '#7', '#8', '#9', '#10',],
        datasets: [{
            label: dataTitle,
            backgroundColor: 'transparent',
            borderColor: 'rgb(69, 173 , 170)',
            data: dataValues
        }]
    },

    // Configuration options go here
    options: {}
});
}



function showDataSetORIGINAL(dataTitle, dataValues)
{
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'Top 10 Most Popular Movies',
            backgroundColor: 'transparent',
            borderColor: 'rgb(69, 173 , 170)',
            data: [0, 10, 5, 2, 20, 30, 45]
        }, 
    {
        label: 'Top 10 Most Popular Movies 2',
            backgroundColor: 'transparent',
            borderColor: 'rgb(69, 173 , 170)',
            data: [5, 15, 7, 5, 10, 40, 15]
    }]
    },

    // Configuration options go here
    options: {}
});
}