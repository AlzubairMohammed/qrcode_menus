import { RendererProps, SFC } from './RendererWrapper';
declare enum PosType {
    Rect = "rect",
    Round = "round",
    Planet = "planet",
    RoundRect = "roundRect"
}
declare enum LineDirection {
    LeftToRight = "left-right",
    UpToDown = "up-down",
    HAndV = "h-v",
    Loop = "loop",
    TopLeftToBottomRight = "topLeft-bottomRight",
    TopRightToBottomLeft = "topRight-bottomLeft",
    Cross = "cross"
}
interface QRLineProps extends RendererProps {
    direction?: LineDirection | string;
    lineWidth?: number;
    lineOpacity?: number;
    lineColor?: string;
    posType?: PosType | string;
    posColor?: string;
}
declare const _default: SFC<QRLineProps>;
export default _default;
