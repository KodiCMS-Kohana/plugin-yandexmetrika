<div class="panel dashboard-widget yandex-traffic-summary-widget">
	<button type="button" class="close remove_widget"><?php echo UI::icon('times'); ?></button>
	<div class="panel-body text-center">
		<div id="YandexTrafficSummary"></div>
	</div>
</div>
<script type="text/javascript">
	
$('.yandex-traffic-summary-widget')
	.on('widget_init', function(e, w ,h) {
		Api.get('plugin-yandex.traffic_summary', {}, function(response) {
			
			function parse_data(data) {
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
			
			if(response.code != 200) {
				$('#YandexTrafficSummary').html(response.message)
				return;
			}
	
			var data = parse_data(response.response.data);

			$('#YandexTrafficSummary').highcharts({
				chart: {
					type: '<?php echo $widget->chart_type; ?>',
					// Edit chart spacing
					spacingBottom: 20,
					spacingTop: 20,
					spacingLeft: 0,
					spacingRight: 0,
					width: w-40,
					height: h-40
				},
				title: {
					text: '<?php echo __($widget->header); ?>'
				},
				yAxis: {
					title: {
						text: '<?php echo __('Total views'); ?>'
					},
					min: 0,
					minorGridLineWidth: 0
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
		$('#YandexTrafficSummary').highcharts().setSize(w-40, h-40);
	});
</script>