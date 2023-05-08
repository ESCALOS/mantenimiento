import './bootstrap';
import "/node_modules/select2/dist/css/select2.css";
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import { Ripple, Select, Tab, Datepicker, Input, Chart, initTE } from "tw-elements";

initTE({ Select, Ripple, Tab, Datepicker, Input, Chart });

Alpine.plugin(focus);

Alpine.start();

window.multiSelect = (DOMElement) => {
    const multiSelect = document.querySelector(DOMElement);
    const multiSelectInstance = Select.getInstance(multiSelect);
    return multiSelectInstance
}

window.datepicker = (DOMElement, DatePicketOptions) => {
    const datepickerDisableFuture = document.querySelector(DOMElement);
    return new Datepicker(datepickerDisableFuture, DatePicketOptions);
}

window.chart = function (DOMElement, typeChart, barData) {
    const dataBarHorizontal = {
        type: typeChart,
        data: barData,
    };

    const optionsBarHorizontal = {
        options: {
            indexAxis: "y",
            scales: {
                x: {
                    stacked: true,
                    grid: {
                        display: true,
                        borderDash: [2],
                        zeroLineColor: "rgba(0,0,0,0)",
                        zeroLineBorderDash: [2],
                        zeroLineBorderDashOffset: [2],
                    },
                    ticks: {
                        color: "rgba(0,0,0, 0.5)",
                    },
                },
                y: {
                    stacked: true,
                    grid: {
                        display: false,
                    },
                    ticks: {
                        color: "rgba(0,0,0, 0.5)",
                    },
                },
            },
        },
    };

    return new Chart(
        document.querySelector(DOMElement),
        dataBarHorizontal,
        optionsBarHorizontal
    );
}

window.updateBChart = (barChart, data, labels, hidden, tag) => {
    barChart.data.labels = labels;
    var max = tag.length;
    var dataset = [];
    for (let index = 0; index < max; index++) {
        var color = getRandomColor();
        dataset = {
            label: tag[index],
            backgroundColor: color,
            hidden: hidden[index],
            data: data[index]
        }
        barChart.data.datasets.push(dataset);
    }
    barChart.update();
}
