const unregisterEditorBlocks = () => {

    const whiteList = ['youtube'];
    
    try {
        const coreEmbedBlockVariations = wp.blocks.getBlockVariations('core/embed');
        const embedBlockVariationNames = coreEmbedBlockVariations.map((variation) => variation.name);
    
        embedBlockVariationNames.forEach((variationName) => {
            if (!whiteList.includes(variationName)) {
                wp.blocks.unregisterBlockVariation('core/embed', variationName);
            }
        });
    } catch (error) {
        console.warn('Could not unregister embed block variations.');
    }
    
}

window.addEventListener('load', unregisterEditorBlocks);