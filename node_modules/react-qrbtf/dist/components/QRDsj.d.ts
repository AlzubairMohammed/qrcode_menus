import { RendererProps, SFC } from './RendererWrapper';
declare enum Type {
    Rect = "rect",
    Dsj = "dsj"
}
interface QRDsjProps extends RendererProps {
    scale?: number;
    crossWidth?: number;
    posWidth?: number;
    posType?: Type | string;
}
declare const _default: SFC<QRDsjProps>;
export default _default;
