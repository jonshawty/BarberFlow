// Seu código JavaScript para criar o gráfico
var ctx = document.getElementById('chartLucros').getContext('2d');

// Defina os dados do seu novo gráfico
var data = {
    labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho'],
    datasets: [{
        label: 'Lucro Mensal',
        backgroundColor: 'rgba(75, 192, 192, 0.2)', // Cor de fundo do gráfico
        borderColor: 'rgba(75, 192, 192, 1)', // Cor da borda do gráfico
        borderWidth: 1,
        data: [2000, 1500, 2200, 1800, 2500, 2100] // Substitua esses valores pelos seus dados reais
    }]
};

// Configurações do gráfico
var options = {
    scales: {
        y: {
            beginAtZero: true
        }
    }
};

// Crie o gráfico
var myChart = new Chart(ctx, {
    type: 'bar', // Tipo de gráfico (pode ser 'bar', 'line', 'pie', etc.)
    data: data,
    options: options
});
