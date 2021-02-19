<script>
import { Pie } from 'vue-chartjs'
import 'chartjs-plugin-colorschemes'

export default {
  name: 'PieChart',
  extends: Pie,
  props: ['data', 'options'],
  mounted() {
    this.renderChart(this.data, this.options)
  },
}
</script>