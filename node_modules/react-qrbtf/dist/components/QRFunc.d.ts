import { RendererProps, SFC } from './RendererWrapper';
declare enum Type {
    Rect = "rect",
    Round = "round"
}
declare enum PosType {
    Rect = "rect",
    Round = "round",
    Planet = "planet",
    RoundRect = "roundRect"
}
interface QRFuncProps extends RendererProps {
    funcType?: string;
    type?: Type | string;
    posType?: PosType | string;
    otherColor1?: string;
    otherColor2?: string;
    posColor?: string;
}
declare const _default: SFC<QRFuncProps>;
export default _default;
