<?php
defined('ABSPATH') || die('Nice Try!');

	// get info via remote get (json)
	// $info = wp_remote_retrieve_body(wp_remote_get('https://api.github.com/users/imranrbx'));
	// $user = json_decode($info);

	// post info (json)
	// $post = wp_remote_retrieve_body( wp_remote_post( 
	// 	'https://jsonplaceholder.typicode.com/posts',[
	// 		'body'	=> [
	// 		'title'		=> 'Dummy Title',
	// 		'body'		=> 'Dummy Content',
	// 		'userID'	=> 1,
	// 		]
	// 	]
		
	//  ) );

	// $posts = wp_remote_retrieve_body( wp_remote_get('https://jsonplaceholder.typicode.com/posts') );
	// $posts = json_decode($posts);

	// print_r($post);

?>
<!-- <h3>Retrive data via API</h3> 
<table class="wp-list-table widefat fixed striped posts">
	<thead>
		<tr>
			<th>Id</th>
			<th>Name</th>
			<th>Image</th>
			<th>Company</th>
			<th>Country</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo $user->id; ?></td>
			<td><?php echo $user->name; ?></td>
			<td><img src="<?php echo $user->avatar_url; ?>" width="50%" alt="" /></td>
			<td><?php echo $user->company; ?></td>
			<td><?php echo $user->location; ?></td>
		</tr>
	</tbody>
</table> 

 <h3>Post data in a specific url</h3> -->
<!-- <table class="wp-list-table widefat fixed striped posts">
	<thead>
		<tr>
			<th>Id</th>
			<th>User ID</th>
			<th>Title</th>
			<th>Body</th>
		</tr>
	</thead>
	<tbody>
		 <?php foreach ($posts as $p): ?>
		<tr>
			<td><?php echo $p->id; ?></td>
			<td><?php echo $p->userID; ?></td>
			<td><?php echo $p->title; ?></td>
			<td><?php echo $p->body; ?></td>
		</tr>
	<?php endforeach; ?> 
	</tbody>
</table> -->
<?php