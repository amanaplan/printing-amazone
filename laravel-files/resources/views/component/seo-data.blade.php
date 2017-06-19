		<title>{{ $title }}</title>
		<meta name="description"            content="{{ $meta_desc }}" />
		<meta property="og:url"             content="{{ Request::url() }}" />
		<meta property="og:site_name"       content="{{ config('app.name') }}" />
		<meta property="og:type"            content="website" />
		<meta property="og:title"           content="{{ $title }}" />
		<meta property="og:description"     content="{{ $meta_desc }}" />
		<meta property="og:image"           content="{{ $og_image }}" /> 