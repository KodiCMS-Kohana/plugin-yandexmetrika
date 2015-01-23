<div class="panel dashboard-widget yandex-summary-widget">
	<button type="button" class="close remove_widget"><?php echo UI::icon('times'); ?></button>
	<div class="panel-body text-center">
		<div id="YandexSummary"></div>
	</div>
</div>
<script type="text/javascript">
	
$('.yandex-summary-widget')
	.on('widget_init', function(e, w ,h) {
		Api.get('plugin-yandex.summary', {
			date_start: '<?php echo $widget->date_start; ?>',
			date_end: '<?php echo $widget->date_end; ?>'
		}, function(response) {
			var data = parse_data(response.response.data);
			$('#YandexSummary').highcharts({
				chart: {
					type: '<?php echo $widget->chart_type; ?>',
					// Edit chart spacing
					spacingBottom: 0,
					spacingTop: 0,
					spacingLeft: 0,
					spacingRight: 0,
					width: w-60,
					height: h-60
				},
				title: {
					text: '<?php echo __($widget->header); ?>'
				},
				yAxis: {
					title: {
						text: '<?php echo __('Total views'); ?>'
					}
				},
				xAxis: {
					categories: data.dates.reverse()
				},
				series: [{
					name: '<?php echo __('Visitors'); ?>',
					data: data.visitors.reverse()
				}, {
					name: '<?php echo __('Visits'); ?>',
					data: data.visits.reverse()
				}, {
					name: '<?php echo __('Page views'); ?>',
					data: data.page_views.reverse()
				}],
				plotOptions: {
					spline: {
						lineWidth: 2
					}
				},
			});
		});
	})
	.on('resize_stop', function(e, gridster, ui, w, h) {
		$('#YandexSummary').highcharts().setSize(w-60, h-60);
	});

	function parse_data(data) {
		var dates = [];
		var datasets = {
			dates: [],
			visitors: [],
			page_views: [],
			visits: []
		};
		for (i in data) {
			datasets['dates'].push(data[i].date);
			datasets['visitors'].push(data[i].visitors);
			datasets['page_views'].push(data[i].page_views);
			datasets['visits'].push(data[i].visits);
		}
		
		return datasets;
	}
</script>