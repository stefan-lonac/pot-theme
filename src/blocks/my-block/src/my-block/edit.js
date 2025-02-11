/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { ColorPalette, InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, RangeControl } from '@wordpress/components';


/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import metadata from './block.json';
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {Element} Element to render.
 */
export default function Edit({ attributes, setAttributes }) {
	const { textColor, backgroundColor, fontSize, linkUrl } = attributes;
	const blockProps = useBlockProps({
		style: {
			color: textColor,
			backgroundColor: backgroundColor,
			fontSize: fontSize
		}
	});

	return (
		<>
			<InspectorControls>
				<PanelBody title={__('Style settings', metadata.textdomain)}>
					<p>{__('Text color', metadata.textdomain)}</p>
					<ColorPalette value={textColor} onChange={(newColor) => setAttributes({ textColor: newColor })} />

					<p>{__('Background color', metadata.textdomain)}</p>
					<ColorPalette value={backgroundColor} onChange={(newBgColor) => setAttributes({ backgroundColor: newBgColor })} />

					<RangeControl
						label={__('Font size', metadata.textdomain)}
						value={fontSize}
						onChange={((newFontSize) => setAttributes({ fontSize: `${newFontSize}px` }))}
						min={8}
						max={56}
					/>
				</PanelBody>

			</InspectorControls>

			<p {...blockProps}>
				<a href={linkUrl || '#'}>{__('Click here', 'text-domain')}</a>
				{__('My Block – hello from the editor!', metadata.textdomain)}
			</p>
		</>
	);
}
