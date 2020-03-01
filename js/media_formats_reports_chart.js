/*
@file
Javascript that renders a Chart.js line chart.
*/

(function (Drupal, $) {
  "use strict";

  var MediaFormatsReportsPieChartCanvas = document.getElementById('media-formats-reports-chart');
  var MediaFormatsReportsPieChartData = drupalSettings.media_formats_reports.chart_data;

  if (MediaFormatsReportsPieChartData != null) {
    var MediaFormatsReportsPieChart = new Chart(MediaFormatsReportsPieChartCanvas, {
      type: 'pie',
      data: MediaFormatsReportsPieChartData,
      options: {
        layout: {
          padding: {
            top: 50,
            bottom: 100,
          }
        }
      }
    });	  
  }

}) (Drupal, jQuery);
