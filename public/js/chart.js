var LineChartRenderer = function(options) {

    var defaults = {
        container: '#line-chart',
        data: [],
        xaxisLabel: 'seconds',
        yaxisLabel: 'V'
    };

    options = $.extend(defaults, options || {});

    var _addSeries = function(label, data) {
        data.push(data);
    };

    var _render = function() {
        $.plot(options.container, options.data, {
            grid: {
                borderWidth: 1,
                minBorderMargin: 20,
                labelMargin: 10,
                backgroundColor: {
                    colors: ["#fff", "#e4f4f4"]
                },
                margin: {
                    top: 8,
                    bottom: 20,
                    left: 20
                },

            },
            xaxis: {
                tickFormatter: function(val, axis) { return val < axis.max ? val : options.xaxisLabel;}
            },
            yaxis: {
                min: 0,
                tickFormatter: function(val, axis) { return val < axis.max ? val : options.yaxisLabel;}
            },
            legend: {
                show: true   
            }
        });
    };

    var API = {
        render: function() {
            _render();
        },
        addSeries: function(data) {
            _addSeries(data);
        },
        setContainer: function(selector) {
            options.container = selector;
        },
        setData: function(data) {
            options.data = data;
        }
    };

    return API;
};

if(window.JSON_RAW_VALUES) {
    $(function() {


        var V = []; // volt
        var I = []; // ampere
        var W = []; // watt

        // Init channels
        V['ATX12V'] = [];
        V['3_3V']   = [];
        V['5V']     = [];
        V['5Vsb']   = [];
        V['12V']    = [];

        I['ATX12V'] = [];
        I['3_3V']   = [];
        I['5V']     = [];
        I['5Vsb']   = [];
        I['12V']    = [];

        W['ATX12V'] = [];
        W['3_3V']   = [];
        W['5V']     = [];
        W['5Vsb']   = [];
        W['12V']    = [];

        $.each(JSON_RAW_VALUES, function( index, row ) {

            var time    = parseInt(row[0]);
            var _ATX12V = parseInt(row[1]);
            var _3_3V   = parseInt(row[2]);
            var _5V     = parseInt(row[3]);
            var _5Vsb   = parseInt(row[4]);
            var _12V    = parseInt(row[5]);

            V['ATX12V'].push([time, _ATX12V * 0.00961]);
            V['3_3V'].push([time, _3_3V * 0.00961]);
            V['5V'].push([time, _5V * 0.00961]);
            V['5Vsb'].push([time, _5Vsb * 0.00961]);
            V['12V'].push([time, _12V * 0.00961]);

            I['ATX12V'].push([time, _ATX12V * 0.00806]);
            I['3_3V'].push([time, _3_3V * 0.00322]);
            I['5V'].push([time, _5V * 0.00806]);
            I['5Vsb'].push([time, _5Vsb * 0.00322]);
            I['12V'].push([time, _12V * 0.00806]);

            keys = ['ATX12V','3_3V','5V','5Vsb','12V'];
            var loc = V['ATX12V'].length-1;
            for(var n in keys) {
                W[keys[n]].push([time, I[keys[n]][loc][1] * V[keys[n]][loc][1]]);
            }

        });

        var voltChart = new LineChartRenderer({
            container: '#volt-chart',
            data: [ 
                    {label: "ATX12V", data:V['ATX12V']},
                    {label: "3.3V", data:V['3_3V']},
                    {label: "5V", data:V['5V']}, 
                    {label: "5Vsb", data:V['5Vsb']},
                    {label: "12V", data:V['12V']}
                ],
        });
        voltChart.render();

        var ampereChart = new LineChartRenderer({
            container: '#ampere-chart',
            data: [ 
                    {label: "ATX12V", data:I['ATX12V']},
                    {label: "3.3V", data:I['3_3V']},
                    {label: "5V", data:I['5V']}, 
                    {label: "5Vsb", data:I['5Vsb']},
                    {label: "12V", data:I['12V']}
                ],
            yaxisLabel: 'I'
        });
        ampereChart.render();

        var wattChart = new LineChartRenderer({
            container: '#watt-chart',
            data: [ 
                    {label: "ATX12V", data:W['ATX12V']},
                    {label: "3.3V", data:W['3_3V']},
                    {label: "5V", data:W['5V']}, 
                    {label: "5Vsb", data:W['5Vsb']},
                    {label: "12V", data:W['12V']}
                ],
            yaxisLabel: 'W'
        });
        wattChart.render();

    });
}