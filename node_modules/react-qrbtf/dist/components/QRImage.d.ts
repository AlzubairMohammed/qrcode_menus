import { RendererProps, SFC } from './RendererWrapper';
declare enum Type {
    Rect = "rect",
    Round = "round"
}
declare enum PosType {
    Rect = "rect",
    Round = "round",
    Planet = "planet"
}
interface QRImageProps extends RendererProps {
    image?: string;
    type?: Type | string;
    size?: number;
    opacity?: number;
    darkColor?: string;
    lightColor?: string;
    posType?: PosType | string;
    posColor?: string;
}
declare const _default: SFC<QRImageProps>;
export default _default;
