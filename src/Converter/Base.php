<?php


namespace DrawerGraphs\Converter;

/**
 * Class Base
 */
class Base implements IConverter
{

    /**
     * @return static
     */
    public static function create()
    {
        return new static();
    }

    /**
     * @param \DrawerGraphs\Command\Command $command
     * @param \Fhaculty\Graph\Graph $graph
     * @return void
     */
    public function convert(\DrawerGraphs\Command\Command $command, \Fhaculty\Graph\Graph $graph)
    {
        $hash_vertices = new \SplObjectStorage();
        foreach ($graph->getVertices() as $vertex) {
            $node = $this->createNode($vertex, $graph);
            $command->addNode($node);
            $hash_vertices[$vertex] = $node;
        }

        $hash_edges = new \SplObjectStorage();
        foreach ($graph->getEdges() as $item) {
            $edge = $this->createEdge($item, $hash_vertices);
            $command->addEdge($edge);
            $hash_edges[$item] = $edge;
        }
    }

    /**
     * @param \Fhaculty\Graph\Vertex $vertex
     * @param \Fhaculty\Graph\Graph $graph
     * @return \DrawerGraphs\Command\Node
     */
    protected function createNode(\Fhaculty\Graph\Vertex $vertex, \Fhaculty\Graph\Graph $graph)
    {
        $node = \DrawerGraphs\Command\Node::create();
        $node->setId($vertex->getId());
        return $node;
    }

    /**
     * @param \Fhaculty\Graph\Edge\Directed $concept_edge
     * @param \SplObjectStorage $hash_vertices
     * @return \DrawerGraphs\Command\Edge
     */
    protected function createEdge(\Fhaculty\Graph\Edge\Directed $concept_edge, \SplObjectStorage $hash_vertices)
    {
        $edge = \DrawerGraphs\Command\Edge::create(
            $hash_vertices[$concept_edge->getVertexStart()],
            $hash_vertices[$concept_edge->getVertexEnd()]
        );
        return $edge;
    }

}