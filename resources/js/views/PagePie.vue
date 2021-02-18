<template>
  <div class="line-chart">
      <PieChart :data="data" :options="options"/>
  </div>
</template>

<script>
import PieChart from '../components/PieChart.vue'

export default {
  name: 'pie-chart',
  components: {
    PieChart,
  },
  props: {
    answerSubjects: String,
    countAnswers: String,
  },
  data() {
    return {
      data: {
        labels: this.answerSubjects,
        datasets: [
          {
            label: 'Answer',
            data: this.countAnswers,
            backgroundColor: ['#0086CC', '#C9396D'],
          },
        ],
      },
      options: {
        plugins: {
          colorschemes: {
            scheme: 'tableau.Tableau20',
          },
        },
      },   
    }
  },
}
Chart.plugins.register({
    afterDatasetsDraw: function (chart, easing) {
        var ctx = chart.ctx;

        chart.data.datasets.forEach(function (dataset, i) {
            var meta = chart.getDatasetMeta(i);
            if (!meta.hidden) {
                meta.data.forEach(function (element, index) {
                    ctx.fillStyle = 'rgb(255, 255, 255)';

                    var fontSize = 20;
                    var fontStyle = 'normal';
                    var fontFamily = 'Helvetica Neue';
                    ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

                    var dataString = chart.data.labels[index];
                    var dataStringNumber = dataset.data[index].toString();

                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';

                    var padding = 5;
                    var position = element.tooltipPosition();
                    ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
                    ctx.fillText(dataStringNumber, position.x, position.y + (fontSize * 1.5) - padding);
                });
            }
        });
    }
});
</script>
<style>
.line-chart{
  width: 400px;
  height: 400px;
  margin: 0 auto;
}
</style>