import "./bootstrap";
import Chart from "chart.js/auto";

let chartInstances = {}; // Funzione per creare un grafico

function createChart(chartId, chartData) {
    const ctx = document.getElementById(chartId).getContext("2d");
    const myChart = new Chart(ctx, {
        type: "line",
        data: chartData,
        options: {
            plugins: {
                legend: {
                    display: false,
                },
            },
            scales: {
                y: {
                    beginAtZero: true,
                },
            },
        },
    });
    chartInstances[chartId] = myChart;
}

// evento si attiva quando il documento HTML è stato completamente analizzato
// Non attende che altre cose come immagini, sottoframe e script asincroni finiscano di caricarsi
document.addEventListener("DOMContentLoaded", function () {
    if (typeof arrYear !== "undefined") {
        const chartData = {
            labels: [
                "January",
                "February",
                "March",
                "April",
                "May",
                "June",
                "July",
                "August",
                "September",
                "October",
                "November",
                "December",
            ],
            datasets: [
                {
                    data: arrYear,
                    backgroundColor: "rgba(255, 99, 132, 0.2)",
                    borderColor: "rgba(255, 99, 132, 1)",
                    borderWidth: 1,
                },
            ],
        };
        // Crea il grafico
        createChart("Year", chartData);
    } else {
        console.error("arrYear è undefined.");
    }

    if (typeof arrMonth !== "undefined") {
        const chartData = {
            labels: [],
            datasets: [
                {
                    data: arrMonth,
                    backgroundColor: "rgba(200, 29, 12, 0.2)",
                    borderColor: "rgba(200, 29, 12, 1)",
                    borderWidth: 1,
                },
            ],
        };
        // Crea il grafico
        createChart("Mounth", chartData);
    } else {
        console.error("arrMonth è undefined.");
    }

    if (typeof arrWeek !== "undefined") {
        const chartData = {
            labels: [
                // "Lunedi",
                // "Martedi",
                // "Mercoledi",
                // "Giovedi",
                // "Venerdi",
                // "Sabato",
                // "Domenica",
            ],
            datasets: [
                {
                    data: arrWeek,
                    backgroundColor: "rgba(200, 29, 12, 0.2)",
                    borderColor: "rgba(200, 29, 12, 1)",
                    borderWidth: 1,
                },
            ],
        };
        // Crea il grafico
        createChart("Week", chartData);
    } else {
        console.error("arrWeek è undefined.");
    }
    const selectElement = document.getElementById("campoSelect");
    selectElement.addEventListener("change", ChangeCampo);
});

async function ChangeCampo() {
    const campoId = document.getElementById("campoSelect").value;
    console.log(campoId);

    const data = { campoId: campoId };

    try {
        const response = await axios.post("/", data, {
            headers: {
                "Content-Type": "application/json; charset=UTF-8",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"), // Use vanilla JS to get the CSRF token
            },
        });

        const json = response.data;
        console.log(json);

        const prenotazioniElement = document.getElementById("prenotazioniOggi");

        if (prenotazioniElement) {
            prenotazioniElement.textContent = json.prenotazioniTotaliOggi;

            updateChart("Year", json.arrYear);
            updateChart("Mounth", json.arrMonth);
            updateChart("Week", json.arrWeek);
        } else {
            console.error("problema non trovato variabili da aggiornanre");
        }
    } catch (error) {
        console.log("Problema nella chiamata:", error);
    }
}

function updateChart(chartId, newData) {
    const chartInstance = chartInstances[chartId];
    if (chartInstance) {
        chartInstance.data.datasets[0].data = newData; // Update data
        chartInstance.update(); // Update il grafico
    } else {
        console.error(`Nessun grafico trovato con l'ID: ${chartId}`);
    }
}
