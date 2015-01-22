<div class="panel dashboard-widget yandex-summary-widget">
	<button type="button" class="close remove_widget"><?php echo UI::icon('times'); ?></button>
	<div class="panel-body text-center">
		<div id="YandexSummary"></div>
	</div>
</div>
<script type="text/javascript">
$(function(){
	Api.get('plugin-yandex.summary', {}, function(response) {

		var data = parse_data(response.response.data);
		
		$('#YandexSummary').highcharts({
			chart: {
				type: 'line',
				// Edit chart spacing
				spacingBottom: 0,
				spacingTop: 0,
				spacingLeft: 0,
				spacingRight: 0,
				width: calculate_w(),
				height: calculate_h()
			},
			title: {
				text: 'Yandex Summary'
			},
			xAxis: {
				categories: data.dates
			},
			series: [{
				name: 'Visitors',
				data: data.visitors
			}, {
				name: 'Visits',
				data: data.visits
			}, {
				name: 'pave views',
				data: data.page_views
			}]
		});
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
	
	$('.yandex-summary-widget')
		.on('start_resize', function(e, gridster, ui) {
			$('#YandexSummary').hide();
		})
		.on('resize', function(e, gridster, ui) {
			$('#YandexSummary').highcharts().setSize(calculate_w(), calculate_h());
			$('#YandexSummary').show();
		});
});

	function calculate_w() {
		var $cont = $('.yandex-summary-widget');
		return $cont.width() - 60;
	}

	function calculate_h() {
		var $cont = $('.yandex-summary-widget');
		return $cont.height() - 60;
	}
</script>