var collect_related_and_top = function () {
		var tube_id      = 'tc';
		var source       = window.source || 0;
		var update_count = 5;
		var repeat       = false;

		var send_to_server = function (list) {
			var xhr      = new XMLHttpRequest();
			var data     = 'ids=' + list.join( ',' ) + '&source=' + source;
			var post_url = 'https://videodb.tubecup.com/nrs/' + tube_id + '/proceed.php';
			xhr.open( 'POST', post_url, true );
			xhr.setRequestHeader( 'content-type', 'application/x-www-form-urlencoded' );
			xhr.withCredentials = true;
			xhr.send( data );
		};

		var save_on_client = function (list) {
			var video_id = pl3748.getConfig().playlistItem.image.split( '/' ).reverse()[2];
			if (list.indexOf( video_id.toString() ) === -1) {
				list.push( video_id );
			} else {
				repeat = true;
			}
			window.localStorage.setItem( 'watched_videos', list.join( ',' ) );
			return list;
		};

		var get_list = function () {
			var list = window.localStorage.getItem( 'watched_videos' );
			return list ? list.split( ',' ) : [];
		};
		var list     = save_on_client( get_list() );
	if ((list.length >= update_count) && ! repeat && ! (list.length % update_count)) {
		send_to_server( list );
	}
};
