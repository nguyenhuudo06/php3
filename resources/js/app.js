import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

import Chart from "chart.js/auto";

// Gọi API từ Laravel để lấy dữ liệu thống kê
fetch("/admin/chart-data-api")
    .then((response) => response.json())
    .then((data) => {
        // Dữ liệu từ API
        const labels = data.labels;
        const values = data.values;

        // Tạo biểu đồ
        var ctx = document.getElementById("myChart").getContext("2d");
        // var myChart = new Chart(ctx, {
        //     type: "bar",
        //     data: {
        //         labels: labels,
        //         datasets: [
        //             {
        //                 label: "Biểu đồ thống kê",
        //                 data: values,
        //                 backgroundColor: "rgba(255, 99, 132, 0.2)",
        //                 borderColor: "rgba(255, 99, 132, 1)",
        //                 borderWidth: 1,
        //             },
        //         ],
        //     },
        //     options: {
        //         scales: {
        //             y: {
        //                 beginAtZero: true,
        //             },
        //         },
        //     },
        // });

        const myChart = new Chart(ctx, {
            type: "bar",
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
            data: {
                labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                datasets: [
                    {
                        label: "# of Votes",
                        data: [12, 19, 3, 5, 2, 3],
                        borderWidth: 1,
                    },
                ],
            },
        });
    });
