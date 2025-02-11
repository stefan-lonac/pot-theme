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
import { useBlockProps } from '@wordpress/block-editor';
import metadata from './block.json';

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
 *
 * @return {Element} Element to render.
 */
export default function save({ attributes }) {
	const { textColor, backgroundColor, fontSize, linkUrl } = attributes;
	const blockProps = useBlockProps.save({
		style: {
			color: textColor,
			backgroundColor: backgroundColor,
			fontSize: fontSize
		}
	});

	return (
		<p {...blockProps}>
			<a href={linkUrl || '#'}>{__('Click here', 'text-domain')}</a>
			{__('My Block – hello from the editor!', metadata.textdomain)}
		</p>
	);
}
