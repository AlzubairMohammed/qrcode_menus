import { RendererProps, SFC } from './RendererWrapper';
declare enum Type {
    None = "none",
    White = "white",
    Bw = "bw"
}
interface QRResImageProps extends RendererProps {
    image?: string;
    contrast?: number;
    exposure?: number;
    alignType?: Type | string;
    timingType?: Type | string;
    otherColor?: string;
    posColor?: string;
}
declare const _default: SFC<QRResImageProps>;
export default _default;
