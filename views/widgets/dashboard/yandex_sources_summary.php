<div class="panel dashboard-widget yandex-sources-summary-widget">
	<button type="button" class="close remove_widget"><?php echo UI::icon('times'); ?></button>
	<div class="panel-body text-center">
		<div id="YandexSourcesSummary"></div>
	</div>
</div>
<script type="text/javascript">
	
$('.yandex-sources-summary-widget')
	.on('widget_init', function(e, w ,h) {
		Api.get('plugin-yandex.sources_summary', {}, function(response) {
			
			function parse_data(data) {
				var series = [];
				for (i in data) {
					series.push([data[i].name, data[i].visits]);
				}

				return series;
			}
			
			$('#YandexSourcesSummary').highcharts({
				chart: {
					spacingBottom: 20,
					spacingTop: 20,
					spacingLeft: 0,
					spacingRight: 0,
					width: w-40,
					height: h-40
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: false
						},
						showInLegend: false
					}
				},
				title: {
					text: '<?php echo __($widget->header); ?>'
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.y}</b>'
				},
				series: [{
					type: '<?php echo $widget->chart_type; ?>',
					name: '<?php echo __('Total visits'); ?>',
					data: parse_data(response.response.data)
				}]
			});
		});
	})
	.on('resize_stop', function(e, gridster, ui, w, h) {
		$('#YandexSourcesSummary').highcharts().setSize(w-40, h-40);
	});
</script>