wp.domReady( () => {

    wp.blocks.registerBlockStyle( 'core/paragraph', [ 
		{
			name: 'font-bold',
			label: 'Bold',
		},

        {
			name: 'font-semibold',
			label: 'Semibold',
		},

        {
            name: 'font-thin',
            label: 'Thin'
        }
	]);

    wp.blocks.registerBlockStyle( 'core/heading', [ 
        {
            name: 'font-title',
            label: 'Title Font'
        },
        {
			name: 'font-semibold',
			label: 'Semibold',
		},
        {
			name: 'font-regular',
			label: 'Regular',
		},
	]);

    wp.blocks.registerBlockStyle( 'core/spacer', [ 
        {
            name: 'decorated',
            label: 'Decorated'
        }
	]);
} );