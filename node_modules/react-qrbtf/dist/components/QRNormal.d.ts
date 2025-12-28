import { RendererProps, SFC } from './RendererWrapper';
declare enum Type {
    Rect = "rect",
    Round = "round",
    Rand = "rand"
}
declare enum PosType {
    Rect = "rect",
    Round = "round",
    Planet = "planet",
    RoundRect = "roundRect"
}
interface QRNormalProps extends RendererProps {
    type?: Type | string;
    posType?: PosType | string;
    size?: number;
    opacity?: number;
    otherColor?: string;
    posColor?: string;
}
declare const _default: SFC<QRNormalProps>;
export default _default;
