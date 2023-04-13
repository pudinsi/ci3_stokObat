<?php defined('__NAJZMI_PUDINTEA__') OR exit('No direct script access allowed'); ?>
	<!-- Page specific javascripts-->
    <!-- /*<script type="text/javascript" src="<?=base_url('assets/');?>chartjs/Chart.min.js"></script> */ -->
	<script type="text/javascript" src="<?=base_url('assets/');?>js/plugins/chart.js"></script>

<script type="text/javascript" language="javascript">
 $(document).ready(function(){
	function pdn_chart() {
	var csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
    var csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';
	var dataJson = {[csrfName]: csrfHash};
	$.ajax({
		url : "<?php echo site_url($pdn_url.'/data_json')?>",
		type : "POST",
		data: dataJson,
		success : function(data) {
			console.log(data);
			var label_nya = [];
			var isinya = [];

			for(var i in data) {
				label_nya.push(data[i].isi_label);
				isinya.push(data[i].isi_data);
			}

			var data = {
				labels: label_nya,
				datasets: [
					{
						label: "Pudin Chart",
						fillColor: "#87CEFA",
						strokeColor: "rgba(220,220,220,1)",
						pointColor: "rgba(220,220,220,1)",
						pointStrokeColor: "#fff",
						pointHighlightFill: "#fff",
						pointHighlightStroke: "rgba(220,220,220,1)",
						data: isinya,
					}
				]
			};
			
			var ctxb = $("#PDNChart").get(0).getContext("2d");
			var barChart = new Chart(ctxb).Bar(data);
		},
		error: function(data) {
			console.log(data);
		}
	});
	};
	
	pdn_chart();
	setInterval(pdn_chart, 360000);
});
</script>
